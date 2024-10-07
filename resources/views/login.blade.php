<form method="POST" action="{{ route('login') }}">
    @csrf
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <input type="checkbox" name="remember"> Remember Me

    <button type="submit">Login</button>
</form>
