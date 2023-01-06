@extends('layout.templates.container', ['useHeader' => true])

@section('header')
    <h1 class="page-header-title">
        <div class="page-header-icon"><i class="fas fa-wallet"></i></div>
        Wallet
    </h1>
@endsection

@section('content')
    <div class="row">
        <x-user.nfts user="{{ $user->id }}" :column="2" />
    </div>
@endsection
