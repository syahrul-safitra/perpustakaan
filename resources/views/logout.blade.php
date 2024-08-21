<form action="{{ url('logoutt') }}" method="POST">
    @csrf
    <button class="btn btn-primary">Logout</button>
</form>

<form action="{{ url('logouttt') }}" method="POST">
    @csrf
    <button class="btn btn-primary">test</button>
</form>
