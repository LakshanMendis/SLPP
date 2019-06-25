<template>
<div :class="{root: true, sidebarClose}">
  <Header />
  <Sidebar />
  <div class="content animated fadeInUp">
    <transition name="router-animation">
      <router-view></router-view>
    </transition>
  </div>
  <footer class="contentFooter">
    Designed and developed by <a href="http://dtinnovations.lk" target="_blank">DTInnovations</a>
  </footer>
</div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

import Sidebar from 'RESO/js/components/Sidebar/Sidebar';
import Header from 'RESO/js/components/Header/Header';

import './Layout.scss';

export default {
  name: 'Layout',
  components: { Sidebar, Header },
  methods: {
    ...mapActions(
      'layout', ['switchSidebar', 'changeSidebarActive'],
    ),
  },
  computed: {
    ...mapState('layout', {
      sidebarClose: state => state.sidebarClose,
    }),
  },
  created() {
  },
};
</script>

<style src="./Layout.scss" lang="scss" />
