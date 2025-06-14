{{-- resources/views/dashboards/dealer.blade.php --}}
@extends('layouts.app-with-sidebar')

@section('content')
@php
  $dealerId = Auth::user()->dealer_id ?? 'default';
  $embedUrl = "https://mmsdesign-crm-dash.lovable.app/embed?filter=dealer/{$dealerId}";
@endphp
<div class="lovable-dashboard-wrapper position-relative" style="padding-top: 56.25%;">
  <iframe
    src="{{ $embedUrl }}"
    style="position: absolute; top:0; left:0; width:100%; height:100%; border:none;"
    title="MMS Design CRM Dealer Dashboard">
  </iframe>
</div>
@endsection
