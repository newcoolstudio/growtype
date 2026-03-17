let modalInitialized = false;

export function modal() {
    if (modalInitialized) {
        return;
    }

    modalInitialized = true;

    const ajaxUrl = window.growtype_ajax?.url || window.growtype_child_ajax?.url || '/wp-admin/admin-ajax.php';

    const appendModalMarkup = (markup) => {
        const template = document.createElement('template');
        template.innerHTML = markup.trim();

        const scripts = Array.from(template.content.querySelectorAll('script'));
        scripts.forEach((script) => script.remove());

        document.body.appendChild(template.content.cloneNode(true));

        scripts.forEach((script) => {
            const executableScript = document.createElement('script');

            Array.from(script.attributes).forEach((attribute) => {
                executableScript.setAttribute(attribute.name, attribute.value);
            });

            executableScript.textContent = script.textContent;
            document.body.appendChild(executableScript);
            executableScript.remove();
        });
    };

    const loadAndShowModal = (trigger, target) => {
        const $trigger = $(trigger);

        console.log('Growtype Modal: loadAndShowModal start', {
            trigger,
            target,
            existsBeforeLoad: !!document.querySelector(target),
        });

        if ($trigger.prop('disabled')) {
            console.log('Growtype Modal: trigger is disabled, skipping', { target, trigger });
            return;
        }

        $trigger.prop('disabled', true);

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'growtype_get_modal',
                modal_id: target,
                ...$trigger.data()
            },
            success: function (response) {
                console.log('Growtype Modal: AJAX success', {
                    target,
                    success: response?.success,
                    hasModal: !!response?.data?.modal,
                    response,
                });

                if (response.success && response.data.modal) {
                    appendModalMarkup(response.data.modal);

                    const modalElement = document.querySelector(target);
                    console.log('Growtype Modal: modal appended', {
                        target,
                        modalElement,
                        hasClassList: !!modalElement?.classList,
                    });

                    if (modalElement) {
                        if (window.bootstrap && window.bootstrap.Modal) {
                            console.log('Growtype Modal: opening appended modal via bootstrap', { target, modalElement });
                            const modalInstance = window.bootstrap.Modal.getOrCreateInstance(modalElement);
                            modalInstance.show();
                        } else if ($.fn.modal) {
                            console.log('Growtype Modal: opening appended modal via jQuery', { target, modalElement });
                            $(target).modal('show');
                        }
                    }

                    $(document).trigger('growtypeModalLoaded', [target, response.data]);
                } else {
                    console.error('Growtype Modal: Failed to load modal', response);
                }
            },
            error: function (err) {
                console.error('Growtype Modal: AJAX error', { target, err });
            },
            complete: function () {
                console.log('Growtype Modal: loadAndShowModal complete', {
                    target,
                    existsAfterLoad: !!document.querySelector(target),
                });
                $trigger.prop('disabled', false);
            }
        });
    };

    document.addEventListener('click', function (event) {
        const trigger = event.target.closest('[data-bs-toggle="modal"]');
        if (!trigger) {
            return;
        }

        const target = trigger.getAttribute('data-bs-target');
        console.log('Growtype Modal: click captured', {
            target,
            trigger,
            eventTarget: event.target,
            currentTarget: event.currentTarget,
            modalExistsAtCapture: !!(target && document.querySelector(target)),
        });

        if (!target) {
            console.log('Growtype Modal: missing target, allowing default flow', { trigger });
            return;
        }

        event.preventDefault();
        event.stopImmediatePropagation();
        console.log('Growtype Modal: prevented default and stopped propagation', {
            target,
            modalExistsAfterPrevent: !!document.querySelector(target),
        });

        const modalElement = document.querySelector(target);
        if (modalElement) {
            console.log('Growtype Modal: existing modal found, opening directly', {
                target,
                modalElement,
                hasClassList: !!modalElement?.classList,
            });
            if (window.bootstrap && window.bootstrap.Modal) {
                const modalInstance = window.bootstrap.Modal.getOrCreateInstance(modalElement);
                modalInstance.show(trigger);
            } else if ($.fn.modal) {
                $(target).modal('show');
            }
            return;
        }

        loadAndShowModal(trigger, target);
    }, true);
}

modal();
