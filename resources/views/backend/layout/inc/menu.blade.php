<div class="menu-container flex-grow-1">
    <ul id="menu" class="menu">
      <li>
        <a href="{{ route('admin.dashboard') }}">
          <i data-cs-icon="shop" class="icon" data-cs-size="18"></i>
          <span class="label">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="#categories" data-href="">
          <i data-cs-icon="cupcake" class="icon" data-cs-size="18"></i>
          <span class="label">Categories</span>
        </a>
        <ul id="categories">
          <li>
            <a href="{{ route('category.index') }}">
              <span class="label">List</span>
            </a>
          </li>
          <li>
            <a href="{{ route('category.create') }}">
              <span class="label">Add New</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#products" data-href="Products.html">
          <i data-cs-icon="cupcake" class="icon" data-cs-size="18"></i>
          <span class="label">Products</span>
        </a>
        <ul id="products">
          <li>
            <a href="{{ route('products.index') }}">
              <span class="label">List</span>
            </a>
          </li>
          <li>
            <a href="{{ route('products.create') }}">
              <span class="label">Add New</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#orders" data-href="Orders.html">
          <i data-cs-icon="cart" class="icon" data-cs-size="18"></i>
          <span class="label">Orders</span>
        </a>
        <ul id="orders">
          <li>
            <a href="{{ route('admin.orderlist') }}">
              <span class="label">List</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#customers" data-href="Customers.html">
          <i data-cs-icon="user" class="icon" data-cs-size="18"></i>
          <span class="label">Customers</span>
        </a>
        <ul id="customers">
          <li>
            <a href="{{ route('admin.customerlist') }}">
              <span class="label">List</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#testimonial" data-href="#">
          <i data-cs-icon="user" class="icon" data-cs-size="18"></i>
          <span class="label">Testimonial</span>
        </a>
        <ul id="testimonial">
          <li>
            <a href="{{ route('testimonial.index') }}">
              <span class="label">List</span>
            </a>
          </li>
          <li>
            <a href="{{ route('testimonial.create') }}">
              <span class="label">Add New</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#storefront" data-href="Storefront.html">
          <i data-cs-icon="screen" class="icon" data-cs-size="18"></i>
          <span class="label">Storefront</span>
        </a>
        <ul id="storefront">
          <li>
            <a href="{{ route('admin.contactList') }}">
              <span class="label">Contact Info</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="{{ route('coupon.index') }}">
          <i data-cs-icon="tag" class="icon" data-cs-size="18"></i>
          <span class="label">Coupon Discount</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i data-cs-icon="gear" class="icon" data-cs-size="18"></i>
          <span class="label">Settings</span>
        </a>
      </li>
    </ul>
  </div>
