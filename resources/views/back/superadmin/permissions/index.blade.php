@extends('back.components.layout')

@section('title', 'Super Admin - Permissions')
@section('page-title', 'Permissions')
@section('crumb')
@include('back.components.crumbs.default')
@endsection

@section('content')

<section class="section">
    <div class="row">
        @livewire('super-admin.permissions')
    </div>
</section>

@endsection
