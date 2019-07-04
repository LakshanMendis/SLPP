<template>
  <b-collapse class="sidebar-collapse" id="sidebar-collapse" :visible="sidebarOpened">
  <nav
    :class="{sidebar: true}"
  >
    <header class="logo">
      <router-link to="/app/dashboard">Members <span class="fw-semi-bold">Portal</span></router-link>
    </header>

    <ul class="nav">
      <NavLink
              :activeItem="activeItem"
              header="Dashboard"
              link="/app/dashboard"
              iconName="flaticon-home"
              index="dashboard"
              isHeader
      />
      <NavLink
              :activeItem="activeItem"
              header="Administrator"
              link="/app/admin"
              iconName="flaticon-share"
              index="admin"
              :childrenLinks="[
          { header: 'Users', link: '/app/admin/users' },
          { header: 'Modules', link: '/app/admin/modules' },
          { header: 'Permissions', link: '/app/admin/permissions' },
          { header: 'Companies', link: '/app/admin/companies' },
          { header: 'Locations', link: '/app/admin/locations' },
          { header: 'Departments', link: '/app/admin/departments' },
          { header: 'Designations', link: '/app/admin/designations' },
        ]"
      />
      <NavLink
              :activeItem="activeItem"
              header="Master"
              link="/app/master"
              iconName="flaticon-link"
              index="master"
              :childrenLinks="[
          { header: 'Titles', link: '/app/master/titles' },
          { header: 'Nationality', link: '/app/master/nationality' },
          { header: 'Religions', link: '/app/master/religions' },
          { header: 'Provinces', link: '/app/master/provinces' },
          { header: 'Districts', link: '/app/master/districts' },
          { header: 'Electorates', link: '/app/master/electorates' },
          { header: 'Local Authorities', link: '/app/master/localauthorities' },
          { header: 'Wards', link: '/app/master/wards' },
          { header: 'GN Divisions', link: '/app/master/gndivisions' },
        ]"
      />
      <NavLink
              :activeItem="activeItem"
              header="Member"
              link="/app/member"
              iconName="flaticon-user"
              index="member"
              :childrenLinks="[
          { header: 'Add New', link: '/app/member/new' },
          { header: 'Update/Inactive', link: '/app/member/update-inactive' },
          { header: 'View', link: '/app/member/view' },
          { header: 'Tagging', link: '/app/member/tagging' },
          { header: 'Categories', link: '/app/member/categories' },
        ]"
      />
      <NavLink
              :activeItem="activeItem"
              header="Templating"
              link="/app/templating"
              iconName="flaticon-file"
              index="templating"
              :childrenLinks="[
          { header: 'Create New', link: '/app/templating/new' },
          { header: 'View', link: '/app/templating/view' },
          { header: 'Update/Inactive', link: '/app/templating/update-inactive' },
          { header: 'Posting', link: '/app/templating/posting' },
        ]"
      />
      <!--<NavLink
              :activeItem="activeItem"
              header="Guides"
              link="/app/guide"
              iconName="flaticon-network"
              index="guide"
              :childrenLinks="[
          { header: 'Typography', link: '/app/guide/typography' },
          { header: 'Tables', link: '/app/guide/tables' },
          { header: 'Notifications', link: '/app/guide/notifications' },
          { header: 'Blank', link: '/app/guide/blank' },
          { header: 'Charts', link: '/app/guide/charts' },
          { header: 'Icons', link: '/app/guide/icons' },
          { header: 'Maps', link: '/app/guide/maps' },
        ]"
      />-->
    </ul>
  </nav>
  </b-collapse>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import NavLink from './NavLink/NavLink';

export default {
  name: 'Sidebar',
  components: { NavLink },
  data() {
    return {
      alerts: [
        {
          id: 0,
          title: 'Sales Report',
          value: 15,
          footer: 'Calculating x-axis bias... 65%',
          color: 'info',
        },
        {
          id: 1,
          title: 'Personal Responsibility',
          value: 20,
          footer: 'Provide required notes',
          color: 'danger',
        },
      ],
    };
  },
  methods: {
    ...mapActions('layout', ['changeSidebarActive', 'switchSidebar']),
    setActiveByRoute() {
      const paths = this.$route.fullPath.split('/');
      paths.pop();
      this.changeSidebarActive(paths.join('/'));
    },
  },
  created() {
    this.setActiveByRoute();
  },
  computed: {
    ...mapState('layout', {
      sidebarOpened: state => !state.sidebarClose,
      activeItem: state => state.sidebarActiveElement,
    }),
  },
};
</script>

<!-- Sidebar styles should be scoped -->
<style src="./Sidebar.scss" lang="scss" scoped/>
