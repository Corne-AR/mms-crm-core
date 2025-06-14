{{-- resources/views/dashboards/internal.blade.php --}}
@extends('layouts.app-with-sidebar')

@section('content')
<div class="lovable-dashboard-wrapper position-relative" style="padding-top: 56.25%;">
  <iframe
    src="https://mmsdesign-crm-dash.lovable.app/embed"
    style="position: absolute; top:0; left:0; width:100%; height:100%; border:none;"
    title="MMS Design CRM Internal Dashboard">
  </iframe>
</div>
@endsection