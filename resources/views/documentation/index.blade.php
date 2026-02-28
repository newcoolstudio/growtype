@extends('documentation.layout.app')

@section('content')
  <style>
    .docs-header {
      padding: 60px 0 40px;
      text-align: center;
      border-bottom: 1px solid var(--doc-header-border);
      margin-bottom: 50px;
    }
    .docs-header h1 {
      font-size: 42px;
      font-weight: 700;
      color: var(--doc-text);
      margin-bottom: 10px;
    }
    .docs-header p {
      font-size: 18px;
      color: var(--doc-text-muted);
      max-width: 500px;
      margin: 0 auto;
    }
    .docs-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 24px;
      padding: 0 15px 60px;
      max-width: 1200px;
      margin: 0 auto;
    }
    .docs-card {
      background: var(--doc-section-bg);
      border: 1px solid var(--doc-section-border);
      border-radius: 12px;
      padding: 28px;
      text-decoration: none;
      color: inherit;
      transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
      display: flex;
      flex-direction: column;
    }
    .docs-card:hover {
      border-color: var(--doc-link);
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(0,0,0,0.15);
      color: inherit;
      text-decoration: none;
    }
    .docs-card-icon {
      width: 44px;
      height: 44px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      margin-bottom: 16px;
    }
    .docs-card h3 {
      font-size: 18px;
      font-weight: 600;
      color: var(--doc-text);
      margin: 0 0 8px;
    }
    .docs-card p {
      font-size: 14px;
      color: var(--doc-text-muted);
      margin: 0;
      line-height: 1.5;
      flex: 1;
    }
    .docs-card-arrow {
      margin-top: 16px;
      font-size: 13px;
      color: var(--doc-link);
      font-weight: 500;
    }
  </style>

  <div class="docs-header">
    <h1>Growtype Documentation</h1>
    <p>Theme components, examples, and style references.</p>
  </div>

  <div class="docs-grid">

    <a href="/growtype/documentation/style-guide" class="docs-card">
      <div class="docs-card-icon" style="background: rgba(88, 166, 255, 0.12); color: #58a6ff;">🎨</div>
      <h3>Style Guide</h3>
      <p>Buttons, forms, typography, alerts, and all available UI components with their CSS classes.</p>
      <div class="docs-card-arrow">View style guide →</div>
    </a>

    <a href="/growtype/documentation/icons" class="docs-card">
      <div class="docs-card-icon" style="background: rgba(63, 185, 80, 0.12); color: #3fb950;">⭐</div>
      <h3>Icons</h3>
      <p>Available icon sets and usage examples for the theme.</p>
      <div class="docs-card-arrow">View icons →</div>
    </a>

  </div>
@endsection
