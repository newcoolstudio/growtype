@extends('documentation.layout.app')

@section('intro')
  <h1>Growtype Style Guide</h1>
  <p>A reference for all theme components and styles.</p>
@endsection

@section('content')
  @include('documentation.content.style-guide.partials.styles')

  <div class="sg-wrapper">
    @include('documentation.content.style-guide.partials.buttons')
    @include('documentation.content.style-guide.partials.forms')
    @include('documentation.content.style-guide.partials.typography')
    @include('documentation.content.style-guide.partials.alerts')
    @include('documentation.content.style-guide.partials.badges')
    @include('documentation.content.style-guide.partials.cards')
    @include('documentation.content.style-guide.partials.tables')
    @include('documentation.content.style-guide.partials.lists')
    @include('documentation.content.style-guide.partials.pagination')
    @include('documentation.content.style-guide.partials.loaders')
    @include('documentation.content.style-guide.partials.layout-grid')
  </div>
@endsection
