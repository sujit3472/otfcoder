<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Sidebar
        </div>

        <div class="card-body">
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin') }}">
                        Dashboard
                    </a>
                </li>
                <br>
                <li role="presentation">
                    <a href="{{ url('admin/user') }}">
                        Users
                    </a>
                </li>
                <li role="presentation">
                    <a href="{{ url('admin/category') }}">
                        Categories
                    </a>
                </li>
                <li role="presentation">
                    <a href="{{ url('admin/product') }}">
                        Products
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
