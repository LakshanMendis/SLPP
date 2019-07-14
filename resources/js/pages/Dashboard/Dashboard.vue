<template>
  <div class="dashboard-page">
    <h1 class="page-title">Dashboard &nbsp;
      <small>
        <small>At a glance</small>
      </small>
    </h1>

    <b-row>
      <b-col lg="6" xs="12">
        <Widget
          title="<h6>Total Stats</h6>"
          close settings customHeader
        >
          <div class="stats-row">
            <div class="stat-item">
              <h6 class="name">Members</h6>
              <p class="value">1,460</p>
            </div>
            <div class="stat-item">
              <h6 class="name">Templates</h6>
              <p class="value">12</p>
            </div>
            <div class="stat-item">
              <h6 class="name">Categories</h6>
              <p class="value">5</p>
            </div>
            <div class="stat-item">
              <h6 class="name">Users</h6>
              <p class="value">4</p>
            </div>
            <div class="stat-item">
              <h6 class="name">Logged Users</h6>
              <p class="value">1</p>
            </div>
          </div>

          <div class="clearfix">
            <div class="float-right">
              <b-button variant="maroon" class="mr-xs" size="sm">Reports</b-button>
            </div>
            <p>For more detail goto reports</p>
          </div>
        </Widget>
      </b-col>
      
      <b-col lg="6" xs="12">
        <Widget
          title="<h6>Transaction Log</h6>"
          close settings customHeader
        >
          <div class="pb-4">
            <p class="help-block text-ellipsis m-0">
              2019-06-06 10:50 AM : Lilan Manoj signed in
            </p>
            <p class="help-block text-ellipsis m-0">
              2019-06-06 09:30 AM : Lilan Manoj signed out
            </p>
            <p class="help-block text-ellipsis m-0">
              2019-06-06 09:24 AM : Lilan Manoj created a new template
            </p>
            <p class="help-block text-ellipsis m-0">
              2019-06-06 09:17 AM : Lilan Manoj updated member details
            </p>
            <p class="help-block text-ellipsis m-0">
              2019-06-06 09:12 AM : Lilan Manoj signed in
            </p>
          </div>
        </Widget>
      </b-col>
    </b-row>

    <b-row>
      <b-col lg="7">
        <Widget>
          <h6>Quick Links</h6>
          <b-row class="pt-3 pb-3">
            <b-col lg="4" class="pb-2">
              <b-dropdown @click="quickClicked('/app/member/view')" block split type="dark" variant="maroon" right size="lg" class="w-100">
                <template slot="button-content">
                  <i class="fa fa-users"></i><br><strong>Members</strong>
                </template>
                <b-dropdown-item @click="quickClicked('/app/member/view')"><i class="fa fa-search"></i> View</b-dropdown-item>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item @click="quickClicked('/app/member/new')"><i class="fa fa-plus"></i> Add</b-dropdown-item>
                <b-dropdown-item @click="quickClicked('/app/member/update-inactive')"><i class="fa fa-pencil"></i> Update</b-dropdown-item>
                <b-dropdown-item @click="quickClicked('/app/member/tagging')"><i class="fa fa-tags"></i> Tag</b-dropdown-item>
              </b-dropdown>
            </b-col>

            <b-col lg="4" class="pb-2">
              <b-dropdown @click="quickClicked('/app/templating/view')" block split type="dark" variant="maroon" right size="lg" class="w-100">
                <template slot="button-content">
                  <i class="fa fa-file"></i><br><strong>Templates</strong>
                </template>
                <b-dropdown-item @click="quickClicked('/app/templating/view')"><i class="fa fa-search"></i> View</b-dropdown-item>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item @click="quickClicked('/app/templating/new')"><i class="fa fa-plus"></i> Create</b-dropdown-item>
                <b-dropdown-item @click="quickClicked('/app/templating/update-inactive')"><i class="fa fa-pencil"></i> Update</b-dropdown-item>
              </b-dropdown>
            </b-col>

            <b-col lg="4" class="pb-2">
              <b-button @click="quickClicked('/app/templating/posting')" block type="dark" variant="maroon" size="lg">
                <i class="fa fa-send"></i><br><strong>Send</strong>
              </b-button>
            </b-col>
          </b-row>

          <b-row class="pt-3 pb-3">
            <b-col lg="4" class="pb-2">
              <b-button block type="dark" variant="maroon" size="lg">
                <i class="fa fa-file-text"></i><br><strong>Log</strong>
              </b-button>
            </b-col>

            <b-col lg="4" class="pb-2">
              <b-button block type="dark" variant="maroon" size="lg">
                <i class="fa fa-print"></i><br><strong>Reports</strong>
              </b-button>
            </b-col>

            <b-col lg="4" class="pb-2">
              <b-dropdown block split type="dark" variant="maroon" right size="lg" class="w-100">
                <template slot="button-content">
                  <i class="fa fa-user"></i><br><strong>Profile</strong>
                </template>
                <b-dropdown-item><i class="fa fa-search"></i> View</b-dropdown-item>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item @click="logout"><i class="fa fa-power-off"></i> Sign out</b-dropdown-item>
              </b-dropdown>
            </b-col>
          </b-row>
        </Widget>
      </b-col>

      <b-col lg="5" xs="12">
        <Widget title="<h6>Calendar</h6>" bodyClass="p-0" settings close customHeader>
          <v-calendar class="v-calendar" :attributes='calendarAttributes'></v-calendar>

          <div class="list-group fs-mini">
            <a href="#" class="list-group-item text-ellipsis">
              <span class="badge badge-pill badge-warning float-right">6:45 PM</span>
              Scheduled to generate using <strong>Template 1</strong> for post via e-mail.
            </a>
            <a href="#" class="list-group-item text-ellipsis">
              <span class="badge badge-pill badge-success float-right">9:41 AM</span>
              Generated using <strong>Template 2</strong> for post via normal post.
            </a>
          </div>
        </Widget>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import Vue from 'vue';
import Widget from 'RESO/js/components/Widget/Widget';

export default {
  name: 'Dashboard',
  components: {
    Widget,
  },
  methods: {
    quickClicked(action){
      if (action == "" || action == null) return;

      this.$router.push(action);
    },
    logout() {
      window.localStorage.setItem('authenticated', false);
      window.localStorage.setItem('access_id', 0);
      window.localStorage.setItem('user_id', 0);

      this.$router.push('/login');
    }
  },
  computed: {
    calendarAttributes() {
      return [
        // Today attribute
        {
          contentStyle: {
            fontWeight: '700',
            fontSize: '.9rem',
          },
          dates: new Date(),
        },
      ];
    },
  },
  created() {
    if (window.localStorage.getItem('authenticated') !== 'true') {
      this.$router.push('/login');
    }
  }
};
</script>

<style src="./Dashboard.scss" lang="scss" />
