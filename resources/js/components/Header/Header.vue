<template>
  <b-navbar toggleable="md" class="header d-print-none">
    <b-navbar-nav class="navbar-nav-mobile ml-auto">
        <b-nav-text class="mr-3">
          <b-alert class="header-alert animated bounceIn delay-2s" dismissible v-model="showNavbarAlert">
            <i class="fa fa-info-circle mr-1"></i> Navigate using menu on left or within dashboard!
          </b-alert>
        </b-nav-text>

        <!-- <b-nav-form class="d-sm-down-none mr-3">
          <b-input-group class="input-group-transparent">
            <b-input-group-text slot="prepend"><i class="la la-search"></i></b-input-group-text>
            <b-input class="input-transparent" id="search-input" placeholder="Search Dashboard" />
          </b-input-group>
        </b-nav-form> -->

        <b-nav-item-dropdown right extra-menu-classes="py-0">
          <template slot="button-content">
            <span class="avatar thumb-sm float-left mr-2">
              <img class="rounded-circle" src="../../assets/people/a5.jpg" alt="..." />
            </span>
            <span class="d-md-down-none d-lg-inline">Lilan <span class="fw-semi-bold">Manoj</span></span>
            <!-- <span class="ml-2 circle bg-warning text-white fw-bold d-md-down-none d-lg-inline-block">13</span> -->
          </template>
          <b-dropdown-item><i class="la la-user" /> My Account</b-dropdown-item>
          <b-dropdown-divider />
          <b-dropdown-item-button @click="logout">
            <i class="la la-sign-out" /> Log Out
          </b-dropdown-item-button>
        </b-nav-item-dropdown>

        <b-nav-item class="divider"></b-nav-item>

        <b-nav-item class="d-md-down-none" @click="logout">
          <i class="la la-power-off px-2" />
        </b-nav-item>

        <b-nav-item class="d-md-none" @click="switchSidebarMethod" >
          <i class="la la-navicon px-2" />
        </b-nav-item>
      </b-navbar-nav>
  </b-navbar>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  name: 'Header',
  computed: {
    ...mapState('layout', {
      sidebarClose: state => state.sidebarClose,
      sidebarStatic: state => state.sidebarStatic,
    }),
  },
  methods: {
    ...mapActions('layout', ['toggleSidebar', 'toggleChat', 'switchSidebar', 'changeSidebarActive']),
    switchSidebarMethod() {
      if (!this.sidebarClose) {
        this.switchSidebar(true);
        this.changeSidebarActive(null);
      } else {
        this.switchSidebar(false);
        const paths = this.$route.fullPath.split('/');
        paths.pop();
        this.changeSidebarActive(paths.join('/'));
      }
    },
    logout() {
      window.localStorage.setItem('authenticated', false);
      this.$router.push('/login');
    },
  },
  created() {

  },
  data() {
    return {
      showNavbarAlert: true
    }
  }
};
</script>

<style src="./Header.scss" lang="scss" scoped />
