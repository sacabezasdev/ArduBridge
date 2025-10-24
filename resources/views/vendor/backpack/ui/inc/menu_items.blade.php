{{-- Default Backpack menu items --}}
<li class="nav-item">
  <a class="nav-link" href="{{ backpack_url('dashboard') }}">
    <i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}
  </a>
</li>

@stack('crud_menu_items')

<x-backpack::menu-item title="Devices" icon="la la-microchip" :link="backpack_url('device')" />
<x-backpack::menu-item title="Measurements" icon="la la-ruler-horizontal" :link="backpack_url('measurement')" />