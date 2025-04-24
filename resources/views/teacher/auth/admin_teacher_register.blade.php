
<form method="POST" action="{{ route('admin_teacher.register') }}">
    @csrf
    <div>
        <label for="name">Name</label>
        <input id="name" type="text" name="name" required autofocus>
    </div>
    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
    </div>
    <div>
        <label for="password-confirm">Confirm Password</label>
        <input id="password-confirm" type="password" name="password_confirmation" required>
    </div>
    <div>
        <label for="role">Role</label>
        <select id="role" name="role" required>
            <option value="admin">Admin</option>
            <option value="teacher">Teacher</option>
        </select>
    </div>
    <div>
        <button type="submit">Register</button>
    </div>
</form>