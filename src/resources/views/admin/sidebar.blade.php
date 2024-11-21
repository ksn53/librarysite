<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="sidebar-sticky pt-3">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('adminpanel') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.book.list') }}">Books</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('books.create') }}">Add book</a>
        </li>
    </ul>
  </div>
</nav>
