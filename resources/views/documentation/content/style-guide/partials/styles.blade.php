<style>
  .sg-section {
    background: var(--doc-section-bg);
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
    border: 1px solid var(--doc-section-border);
  }

  /* Target only first-level headings/text in the style guide items */
  .sg-item > h1,
  .sg-item > h2,
  .sg-item > h3,
  .sg-item > h4,
  .sg-item > h5,
  .sg-item > h6,
  .sg-item > p,
  .sg-item > ol,
  .sg-item > ul,
  .sg-item > .form-group label,
  .sg-item > .form-check label,
  .sg-item > .container,
  .sg-item > .row .col,
  .sg-item > blockquote {
    color: var(--doc-text) !important;
  }

  .sg-title {
    border-bottom: 2px solid var(--doc-header-border);
    padding-bottom: 10px;
    margin-bottom: 20px;
    font-size: 24px;
    font-weight: bold;
    color: var(--doc-text);
  }
  .sg-item {
    margin-bottom: 20px;
  }
  .sg-label {
    display: block;
    margin-bottom: 8px;
    font-size: 12px;
    color: var(--doc-text-muted);
    font-family: monospace;
  }

  /* Cards */
  .sg-card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 16px;
  }

  .card-doc {
    position: relative;
    padding: 18px 18px 20px;
    border-radius: 14px;
    background: linear-gradient(145deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
    border: 1px solid rgba(255,255,255,0.08);
    box-shadow: 0 12px 30px rgba(0,0,0,0.18);
    color: var(--doc-text);
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .card-doc:hover {
    transform: translateY(-3px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.24);
  }

  .card-doc__label {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--doc-text-muted);
    margin-bottom: 10px;
  }

  .card-doc h4 {
    margin: 0 0 8px;
    font-weight: 700;
    font-size: 1.05rem;
  }

  .card-doc p {
    margin: 0 0 12px;
    color: var(--doc-text-muted);
  }

  .card-doc__meta {
    font-size: 12px;
    color: var(--doc-text-muted);
  }

  .card-doc__badge {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 999px;
    background: rgba(255,255,255,0.1);
    color: #fff;
    font-weight: 700;
    font-size: 0.8rem;
    letter-spacing: 0.02em;
  }

  .card-doc--gradient {
    background: linear-gradient(135deg, rgba(109, 85, 255, 0.35), rgba(40, 182, 255, 0.25));
    border-color: rgba(255,255,255,0.12);
  }

  .card-doc--glass {
    backdrop-filter: blur(8px);
    background: rgba(255,255,255,0.05);
  }
</style>
