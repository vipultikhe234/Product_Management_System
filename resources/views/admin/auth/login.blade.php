@extends('admin.layouts.app')

@section('content')
<div class="login-container">
    <div class="card login-card">
        <h2 style="margin-top: 0; margin-bottom: 1.5rem; text-align: center;">Admin Login</h2>
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" required value="{{ old('email') }}">
                @error('email') <span style="color: var(--danger-color); font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
        </form>
    </div>
</div>
@endsection
