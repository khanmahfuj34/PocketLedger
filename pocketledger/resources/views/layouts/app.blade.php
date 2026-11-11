<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PocketLedger</title>
</head>
<body>

    <header>
        <h2>PocketLedger</h2>
        <nav>
            <a href="/dashboard">Dashboard</a>
            <a href="/transactions">Transactions</a>
            <a href="{{ route('budgets.index') }}">Budgets</a>
            <a href="{{ route('reports.index') }}">Reports</a>
            <a href="/settings">Settings</a>

            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit">Logout</button>
                </form>
            @endauth
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>© 2026 PocketLedger</p>
    </footer>

</body>
</html>