@extends('user.layouts.app')

@section('content')
<div class="login-container">
    <div class="card login-card">
        <h2 style="margin-top: 0; margin-bottom: 1.5rem; text-align: center;">Register</h2>
        <form action="{{ route('user.register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-input" required value="{{ old('name') }}">
                @error('name') <span style="color: var(--danger-color); font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" required value="{{ old('email') }}">
                @error('email') <span style="color: var(--danger-color); font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" required>
                @error('password') <span style="color: var(--danger-color); font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>
             <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-input" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Register</button>
        </form>
        <div style="text-align: center; margin-top: 1rem; font-size: 0.9rem;">
            Already have an account? <a href="{{ route('user.login') }}" style="color: var(--accent-color);">Login</a>
        </div>
    </div>
</div>
@endsection
