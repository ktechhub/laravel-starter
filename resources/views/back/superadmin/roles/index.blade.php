@extends('back.components.layout')

@section('title', 'Super Admin - Roles')

@section('page-title', 'Roles')
@section('crumb')
@include('back.components.crumbs.default')
@endsection

@section('content')

<section class="section">
    <div class="row">
        @livewire('super-admin.roles')
    </div>
</section>

@endsection
