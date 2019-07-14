<template>
  <b-collapse class="sidebar-collapse" id="sidebar-collapse" :visible="sidebarOpened">
  <nav
    :class="{sidebar: true}"
  >
    <header class="logo">
      <router-link to="/app/dashboard">
        <em>e</em>-<span class="fw-semi-bold">SLPP</span>
      </router-link>
    </header>
    
    <div v-if="isMenuLoading" class="text-center loading">
      <b-alert variant="maroon" show>
        <h5 class="mt-2 mb-3">Loading Menu..</h5>
        <b-spinner class="mt-2 mb-4" variant="danger" type="grow" label="Loading Menu"></b-spinner>
      </b-alert>
    </div>

    <ul class="nav">
      <NavLink
        v-for="item in navLinks"
        :key="item.key"
        :activeItem="activeItem"
        :header="item.header"
        :link="item.link"
        :iconName="item.iconName"
        :index="item.index"
        :isHeader="item.isHeader"
        :childrenLinks="item.childrenLinks"
      />
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
      isMenuLoading: false,
      navLinks: [],
    };
  },
  methods: {
    ...mapActions('layout', ['changeSidebarActive', 'switchSidebar']),
    setActiveByRoute() {
      const paths = this.$route.fullPath.split('/');
      paths.pop();
      this.changeSidebarActive(paths.join('/'));
    },
    load_menu() {
      this.isMenuLoading = true;

      const access_id = window.localStorage.getItem('access_id');

      window.axios.post('/api/authenticate/menu',{ 'access_id' : access_id }).then(({data}) => {
        this.isMenuLoading = false;

        if (data.result) {
          this.navLinks = data.data;
        }
      }).catch((e) => {
        this.isMenuLoading = false;

        console.error(e);
      });
    }
  },
  created() {
    this.setActiveByRoute();
    this.load_menu();
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
