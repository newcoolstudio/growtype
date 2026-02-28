@extends('documentation.layout.app')

@section('intro')
  <h1>Growtype Icons</h1>
  <p>Available icons using the theme's icon font (Fontello).</p>
@endsection

@section('content')
  @php
    $icons = [
      'icon-minus' => '0xe800',
      'icon-heart' => '0xe801',
      'icon-phone-circled' => '0xe802',
      'icon-clock' => '0xe803',
      'icon-search' => '0xe804',
      'icon-truck-filled' => '0xe805',
      'icon-search-1' => '0xe806',
      'icon-icon' => '0xe807',
      'icon-heart-empty' => '0xe808',
      'icon-credit-card' => '0xe809',
      'icon-clock-2' => '0xe80a',
      'icon-mail' => '0xe80b',
      'icon-info' => '0xe828',
      'icon-envelope-circled' => '0xe8b0',
      'icon-linkedin' => '0xe8b1',
      'icon-uniE934' => '0xe934',
      'icon-uniE935' => '0xe935',
      'icon-uniE936' => '0xe936',
      'icon-uniE937' => '0xe937',
      'icon-uniE965' => '0xe965',
      'icon-uniE966' => '0xe966',
      'icon-uniE967' => '0xe967',
      'icon-uniE977' => '0xe977',
      'icon-support' => '0xe982',
      'icon-uniE988' => '0xe988',
      'icon-uniE989' => '0xe989',
      'icon-uniE98A' => '0xe98a',
      'icon-uniE98C' => '0xe98c',
      'icon-uniE98E' => '0xe98e',
      'icon-uniE98F' => '0xe98f',
      'icon-card' => '0xe990',
      'icon-uniE993' => '0xe993',
      'icon-uniE99F' => '0xe99f',
      'icon-envelope' => '0xe9a7',
      'icon-uniE9AE' => '0xe9ae',
      'icon-uniE9B0' => '0xe9b0',
      'icon-uniE9B7' => '0xe9b7',
      'icon-profile' => '0xe9bd',
      'icon-paper-plane' => '0xe9bf',
      'icon-arrow-up' => '0xea32',
      'icon-arrow-down' => '0xea33',
      'icon-pencil' => '0xea82',
      'icon-trash' => '0xea83',
      'icon-compare' => '0xeb18',
      'icon-mail-alt' => '0xf0e0',
    ];
  @endphp

  <style>
    /* ... existing styles ... */
    .icons-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
      gap: 16px;
    }
    .doc-icon-card {
      background: var(--doc-section-bg);
      border: 1px solid var(--doc-section-border);
      border-radius: 8px;
      padding: 20px 10px;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
      cursor: pointer;
      position: relative;
    }
    .doc-icon-card:hover {
      border-color: var(--doc-link);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .doc-icon-card:active {
      transform: translateY(0);
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .icon-preview {
      font-size: 32px;
      margin-bottom: 12px;
      color: var(--doc-text);
    }
    .icon-name {
      font-size: 12px;
      color: var(--doc-text-muted);
      font-family: monospace;
      word-break: break-all;
    }
    .icon-code {
      font-size: 10px;
      color: var(--doc-text-muted);
      opacity: 0.6;
      margin-top: 4px;
    }

    .dashicons, .dashicons-before:before {
      width: initial;
      height: initial;
    }

    /* Generated Icon Styles */
    @foreach($icons as $icon => $code)
    .{{ $icon }}:before {
      content: "\{!! str_replace('0x', '', $code) !!}";
    }
    @endforeach
  </style>

  <h2 style="margin-top: 40px; margin-bottom: 20px; border-bottom: 1px solid var(--doc-header-border); padding-bottom: 10px;">Growtype Icons</h2>
  <div class="icons-grid">
    @foreach($icons as $icon => $code)
      <div class="doc-icon-card">
        <i class="icon-preview {{ $icon }}"></i>
        <div class="icon-name">{{ $icon }}</div>
        <div class="icon-code">{{ $code }}</div>
      </div>
    @endforeach
  </div>

  <h2 style="margin-top: 60px; margin-bottom: 20px; border-bottom: 1px solid var(--doc-header-border); padding-bottom: 10px;">WordPress Dashicons</h2>
  <p style="margin-bottom: 20px; color: var(--doc-text-muted);">Standard WordPress admin icons. See full list at <a href="https://developer.wordpress.org/resource/dashicons/" target="_blank" style="color: var(--doc-link);">developer.wordpress.org</a>.</p>
  
  <div class="icons-grid">
    @php
      $dashicons = [
        'dashicons-menu', 'dashicons-admin-site', 'dashicons-dashboard', 'dashicons-admin-post', 
        'dashicons-admin-media', 'dashicons-admin-links', 'dashicons-admin-page', 'dashicons-admin-comments', 
        'dashicons-admin-appearance', 'dashicons-admin-plugins', 'dashicons-admin-users', 'dashicons-admin-tools', 
        'dashicons-admin-settings', 'dashicons-admin-network', 'dashicons-admin-home', 'dashicons-admin-generic', 
        'dashicons-welcome-write-blog', 'dashicons-welcome-add-page', 'dashicons-welcome-view-site', 
        'dashicons-welcome-widgets-menus', 'dashicons-welcome-comments', 'dashicons-welcome-learn-more', 
        'dashicons-format-aside', 'dashicons-format-image', 'dashicons-format-gallery', 'dashicons-format-video', 
        'dashicons-format-status', 'dashicons-format-quote', 'dashicons-format-chat', 'dashicons-format-audio', 
        'dashicons-camera', 'dashicons-images-alt', 'dashicons-images-alt2', 'dashicons-video-alt', 
        'dashicons-video-alt2', 'dashicons-video-alt3', 'dashicons-media-archive', 'dashicons-media-audio', 
        'dashicons-media-code', 'dashicons-media-default', 'dashicons-media-document', 'dashicons-media-interactive', 
        'dashicons-media-spreadsheet', 'dashicons-media-text', 'dashicons-media-video', 'dashicons-playlist-audio', 
        'dashicons-playlist-video', 'dashicons-controls-play', 'dashicons-controls-pause', 'dashicons-controls-forward', 
        'dashicons-controls-skipforward', 'dashicons-controls-back', 'dashicons-controls-skipback', 
        'dashicons-controls-repeat', 'dashicons-controls-volumeon', 'dashicons-controls-volumeoff', 
        'dashicons-image-crop', 'dashicons-image-rotate', 'dashicons-image-flip-vertical', 
        'dashicons-image-flip-horizontal', 'dashicons-undo', 'dashicons-redo', 'dashicons-yes', 'dashicons-no', 
        'dashicons-plus', 'dashicons-plus-alt', 'dashicons-minus', 'dashicons-dismiss', 'dashicons-marker', 
        'dashicons-star-filled', 'dashicons-star-half', 'dashicons-star-empty', 'dashicons-flag', 'dashicons-info', 
        'dashicons-warning', 'dashicons-share', 'dashicons-share-alt', 'dashicons-share-alt2', 'dashicons-twitter', 
        'dashicons-rss', 'dashicons-email', 'dashicons-email-alt', 'dashicons-facebook', 'dashicons-googleplus', 
        'dashicons-networking', 'dashicons-hammer', 'dashicons-art', 'dashicons-migrate', 'dashicons-performance', 
        'dashicons-universal-access', 'dashicons-universal-access-alt', 'dashicons-tickets', 'dashicons-nametag', 
        'dashicons-clipboard', 'dashicons-heart', 'dashicons-megaphone', 'dashicons-schedule',
      ];
    @endphp

    @foreach($dashicons as $icon)
      <div class="doc-icon-card">
        <i class="icon-preview dashicons {{ $icon }}"></i>
        <div class="icon-name">{{ $icon }}</div>
      </div>
    @endforeach
  </div>

  <div id="copy-toast" style="visibility: hidden; min-width: 200px; background-color: var(--doc-header-bg); color: var(--doc-text); border: 1px solid var(--doc-link); text-align: center; border-radius: 4px; padding: 12px; position: fixed; z-index: 1000; left: 50%; bottom: 30px; transform: translateX(-50%); box-shadow: 0 4px 12px rgba(0,0,0,0.2); opacity: 0; transition: opacity 0.3s, bottom 0.3s;">
    Copied to clipboard!
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var cards = document.querySelectorAll('.doc-icon-card');
      var toast = document.getElementById('copy-toast');
      var timeout;

      cards.forEach(function(card) {
        card.addEventListener('click', function() {
          var nameEl = card.querySelector('.icon-name');
          if (nameEl) {
            var text = nameEl.textContent.trim();
            navigator.clipboard.writeText(text).then(function() {
              showToast('Copied: ' + text);
            }, function(err) {
              console.error('Could not copy text: ', err);
            });
          }
        });
      });

      function showToast(message) {
        toast.textContent = message;
        toast.style.visibility = 'visible';
        toast.style.opacity = '1';
        toast.style.bottom = '50px';
        
        clearTimeout(timeout);
        timeout = setTimeout(function() {
          toast.style.visibility = 'hidden';
          toast.style.opacity = '0';
          toast.style.bottom = '30px';
        }, 2000);
      }
    });
  </script>
@endsection
