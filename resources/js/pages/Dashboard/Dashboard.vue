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
                <b-dropdown-item><i class="fa fa-pencil"></i> Update</b-dropdown-item>
                <b-dropdown-item><i class="fa fa-tags"></i> Tag</b-dropdown-item>
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
                <b-dropdown-item><i class="fa fa-pencil"></i> Update</b-dropdown-item>
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
                <b-dropdown-item><i class="fa fa-power-off"></i> Sign out</b-dropdown-item>
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
    
    <!-- <b-row>
      <b-col lg="4" xs="12">
        <Widget
          title="<h6><span class='badge badge-danger'>New</span> Messages</h6>"
          refresh close customHeader
        >
          <div class="widget-body p-0">
            <div class="list-group list-group-lg">
              <a class="list-group-item" href="#">
                <span class="thumb-sm float-left mr">
                  <img class="rounded-circle" src="../../assets/people/a2.jpg" alt="..." />
                  <i class="status status-bottom bg-success" />
                </span>
                <div>
                  <h6 class="m-0">Chris Gray</h6>
                  <p class="help-block text-ellipsis m-0">
                    Hey! What&apos;s up? So many times since we
                  </p>
                </div>
              </a>
              <a class="list-group-item" href="#">
                <span class="thumb-sm float-left mr">
                  <img class="rounded-circle" src="../../assets/people/a4.jpg" alt="..." />
                  <i class="status status-bottom bg-success" />
                </span>
                <div>
                  <h6 class="m-0">Jamey Brownlow</h6>
                  <p class="help-block text-ellipsis m-0">
                    Good news coming tonight. Seems they agreed to proceed
                  </p>
                </div>
              </a>
              <a class="list-group-item" href="#">
                <span class="thumb-sm float-left mr">
                  <img class="rounded-circle" src="../../assets/people/a1.jpg" alt="..." />
                  <i class="status status-bottom bg-warning" />
                </span>
                <div>
                  <h6 class="m-0">Livia Walsh</h6>
                  <p class="help-block text-ellipsis m-0">Check my latest email plz!</p>
                </div>
              </a>
              <a class="list-group-item" href="#">
                <span class="thumb-sm float-left mr">
                  <img class="rounded-circle" src="../../assets/people/a5.jpg" alt="..." />
                  <i class="status status-bottom bg-danger" />
                </span>
                <div>
                  <h6 class="m-0">Jaron Fitzroy</h6>
                  <p class="help-block text-ellipsis m-0">What about summer break?</p>
                </div>
              </a>
            </div>
          </div>
          <footer class="bg-widget mt">
            <input type="search" class="form-control form-control-sm" placeholder="Search" />
          </footer>
        </Widget>
      </b-col>
      <b-col lg="4" xs="12">
        <Widget
          title="<h6> Market <span class='fw-semi-bold'>Stats</span></h6>"
          close customHeader
        >
          <div class="widget-body">
            <h3>$720 Earned</h3>
            <p class="fs-mini text-muted mb mt-sm">
              Target <span class="fw-semi-bold">$820</span> day earnings
              is <span class="fw-semi-bold">96%</span> reached.
            </p>
          </div>
          <div class="widget-bottom-overflow">
            <table class="table table-striped table-sm">
              <thead class="no-bd">
                <tr>
                  <th>
                    <div class="checkbox abc-checkbox">
                      <input
                        type="checkbox"
                        class="mt-0"
                        id="checkbox210"
                        @click="checkTable(0)"
                        :checked="checkedArr[0]"
                      />
                      <label for="checkbox210" />
                    </div>
                  </th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="checkbox abc-checkbox">
                      <input
                        type="checkbox"
                        class="mt-0"
                        id="checkbox212"
                        @click="checkTable(1)"
                        :checked="checkedArr[1]"
                      />
                      <label for="checkbox212" />
                    </div>
                  </td>
                  <td>HP Core i7</td>
                  <td class="text-align-right fw-semi-bold">$346.1</td>
                </tr>
                <tr>
                  <td>
                    <div class="checkbox abc-checkbox">
                      <input
                        type="checkbox"
                        class="mt-0"
                        id="checkbox214"
                        @click="checkTable(2)"
                        :checked="checkedArr[2]"
                      />
                      <label for="checkbox214" />
                    </div>
                  </td>
                  <td>Air Pro</td>
                  <td class="text-align-right fw-semi-bold">$533.1</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="widget-body mt-xlg chart-overflow-bottom">
            <area-chart class="area-chart" height="100px" :options="{legend: false, scales: {yAxes: [{display: false}], xAxes: [{display: false}]}}"  :chart-data="dataCollection"></area-chart>
          </div>
        </Widget>
      </b-col>
    </b-row> -->
  </div>
</template>

<script>
import Vue from 'vue';
import Widget from 'RESO/js/components/Widget/Widget';
import AnimatedNumber from "animated-number-vue";
import AreaChart from './components/AreaChart/AreaChart';

const todos = [
  {
    description: 'Take Sebastian to basketball practice.',
    isComplete: false,
    dates: { weekdays: 6, weeklyInterval: 2 }, // Every other Friday
    color: '#ff8080',       // Red
  },
  {
    description: 'German courses',
    isComplete: false,
    dates: new Date(),
    color: '#64a4ff',       // Red
  },
  {
    description: 'Constitution Day',
    isComplete: false,
    dates: new Date(Date.now() + 6*24*60*60*1000), // in 6 days
    color: '#6ae696',       // Red
  },
];

export default {
  name: 'Dashboard',
  components: {
    Widget,
    AnimatedNumber,
    AreaChart
  },
  data() {
    return {
      checkedArr: [false, false, false],
      dataCollection: null,
      todos
    };
  },
  mounted () {
    this.fillData();
  },
  methods: {
    checkTable(id) {
      let arr = [];
      if (id === 0) {
        const val = !this.checkedArr[0];
        for (let i = 0; i < this.checkedArr.length; i += 1) {
          arr[i] = val;
        }
      } else {
        arr = this.checkedArr;
        arr[id] = !arr[id];
      }
      if (arr[0]) {
        let count = 1;
        for (let i = 1; i < arr.length; i += 1) {
          if (arr[i]) {
            count += 1;
          }
        }
        if (count !== arr.length) {
          arr[0] = !arr[0];
        }
      }
      Vue.set(this, 'checkedArr', arr);
    },
    fillData () {
      this.dataCollection = {
        labels: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()],
        datasets: [
          {
            label: 'Data One',
            backgroundColor: '#f87979',
            borderColor: 'transparent',
            data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()]
          }, {
            label: 'Data Two',
            backgroundColor: '#7c87f8',
            borderColor: 'transparent',
            data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()]
          }
        ]
      }
    },
    getRandomInt () {
      return Math.floor(Math.random() * (50 - 5 + 1)) + 5
    },
    quickClicked(action){
      if (action == "" || action == null) return;

      this.$router.push(action);
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
        // Attributes for todos
        ...this.todos.map(todo => ({
          dates: todo.dates,
          dot: {
            backgroundColor: todo.color,
            opacity: todo.isComplete ? 0.3 : 1,
          },
          popover: {
            label: todo.description,
          },
        })),
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
