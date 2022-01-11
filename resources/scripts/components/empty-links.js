function preventClicksOnEmptyLinks() {
  $('a[href="#"]').click(function(event){
    event.preventDefault();
  });
}

export {preventClicksOnEmptyLinks};
