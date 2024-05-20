<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">NTU Dormotory Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('student.index') }}">學生</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('packages.index') }}">包裹</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('visitors.index') }}">訪客</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('equipments.index') }}">器材</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
