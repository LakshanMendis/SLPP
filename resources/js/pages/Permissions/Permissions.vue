<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>Permission</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Master - <span class="fw-semi-bold">Permission</span>
    </h1>

    <b-row>
      <b-col md="12">
        <Widget>
          <b-row>
            <b-col md="9" class="pl-3 mb-2">
              <multiselect v-model="search.select_user" class="search_user" id="search_user" placeholder="Search user" open-direction="bottom" :options="search.load_users" :multiple="false" :searchable="true" :loading="search.loading" :internal-search="false" :clear-on-select="false" :close-on-select="true" :options-limit="300" :limit="3" :limit-text="limitText" :max-height="300" :show-no-results="true" :hide-selected="false" @search-change="searchUser" @select="selectedUser">
                <span slot="noResult">No matching members found</span>
                <template slot="singleLabel" slot-scope="props"><span class="option__desc"><span class="option__title">[{{ props.option.employee_no }}] {{ props.option.firstname }} {{ props.option.lastname }}</span></span></template>
                <template slot="option" slot-scope="props">
                  <div class="option__desc"><span class="option__title">[{{ props.option.employee_no }}] {{ props.option.firstname }} {{ props.option.lastname }}</span></div>
                </template>
              </multiselect>
            </b-col>

            <b-col md="3" class="pl-3 pt-1">
              <b-button class="mr-2" size="lg" variant="danger" @click="clearSearch"><i class="fa fa-close"></i> Clear</b-button>
              <b-button class="ml-2" size="lg" variant="success" @click="savePermissions"><i class="fa fa-check"></i> Save All</b-button>
            </b-col>
          </b-row>
        </Widget>
      </b-col>
    </b-row>

    <b-row>
      <b-col md="6">
        <Widget>
          <b-row>
            <b-col md="12">
              <h5>Menu Permissions</h5><hr/>
            </b-col>
          </b-row>

          <b-row>
            <b-col md="12">
              <ul>
                <li 
                  v-for="item in menu_permissions.all"
                  :key = "item.id"
                  class="mb-2 mt-4"
                >
                  <b-form-checkbox
                    :key = "item.id"
                    :id="item.code"
                    v-model="menu_permissions.selected[item.id]"
                    :name="item.code"
                    :value="item.id"
                    :unchecked-value=null
                    @input="uncheckChildrenIfUnchecked('menu',item.id,item.children)"
                  >
                    <span class="icon">
                      <i :class="fullIconName(item.icon)"></i>
                    </span>
                    <strong>{{ item.name }}</strong>
                    <b-badge v-if="[item.code != '']" variant="primary">{{ item.code }}</b-badge>
                  </b-form-checkbox>
                
                  <ul v-if="[item.children.length > 0]">
                    <li 
                      v-for="child in item.children"
                      :key = "child.id"
                      class="mb-1 mt-2 ml-5"
                    >
                      <b-form-checkbox
                        :key = "child.id"
                        :id="child.code"
                        v-model="menu_permissions.selected[child.id]"
                        :name="child.code"
                        :value="child.id"
                        :unchecked-value=null
                        @change="checkParent('menu',child.parent_id)"
                      >
                        <span class="icon">
                          <i :class="fullIconName(child.icon)"></i>
                        </span>
                        {{ child.name }}
                        <b-badge v-if="[child.code != '']" variant="primary">{{ child.code }}</b-badge>
                      </b-form-checkbox>
                    </li>
                  </ul>
                </li>
              </ul>
            </b-col>
          </b-row>
        </Widget>
      </b-col>

      <b-col md="6">
        <Widget>
          <b-row>
            <b-col md="12">
              <h5>Other Permissions</h5><hr/>
            </b-col>
          </b-row>

          <b-row>
            <b-col md="12">
              <ul>
                <li 
                  v-for="item in other_permissions.all"
                  :key = "item.id"
                  class="mb-2 mt-4"
                >
                  <b-form-checkbox
                    :key = "item.id"
                    :id="item.code"
                    v-model="other_permissions.selected[item.id]"
                    :name="item.code"
                    :value="item.id"
                    :unchecked-value=null
                    @input="uncheckChildrenIfUnchecked('other',item.id,item.children)"
                  >
                    <span class="icon">
                      <i :class="fullIconName(item.icon)"></i>
                    </span>
                    <strong>{{ item.name }}</strong>
                    <b-badge v-if="[item.code != '']" variant="primary">{{ item.code }}</b-badge>
                  </b-form-checkbox>
                
                  <ul v-if="[item.children.length > 0]">
                    <li 
                      v-for="child in item.children"
                      :key = "child.id"
                      class="mb-1 mt-2 ml-5"
                    >
                      <b-form-checkbox
                        :key = "child.id"
                        :id="child.code"
                        v-model="other_permissions.selected[child.id]"
                        :name="child.code"
                        :value="child.id"
                        :unchecked-value=null
                        @change="checkParent('other',child.parent_id)"
                      >
                        <span class="icon">
                          <i :class="fullIconName(child.icon)"></i>
                        </span>
                        {{ child.name }}
                        <b-badge v-if="[child.code != '']" variant="primary">{{ child.code }}</b-badge>
                      </b-form-checkbox>
                    </li>
                  </ul>
                </li>
              </ul>
            </b-col>
          </b-row>
        </Widget>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import Widget from 'RESO/js/components/Widget/Widget';
import Multiselect from 'vue-multiselect';

export default {
  name: 'Permission',
  components: { Widget, Multiselect },
  data() {
    return {
      global_user_id: 0,
      global_access_id: 0,
      menu_permissions: {
        all: [],
        selected: [],
      },
      other_permissions: {
        all: [],
        selected: [],
      },
      search: {
        select_user: '',
        load_users: [],
        loading: false
      },
    }
  },
  methods: {
    allPermissions() {
      const para = {
        r: 'all-active'
      }

      window.axios.get('/api/permission', { params: para }).then(({ data }) => {
        this.menu_permissions.all = data.data.menu;
        this.other_permissions.all = data.data.other;
      });
    },
    limitText (count) {
      return `and ${count} other users`
    },
    searchUser (query) {
      this.search.loading = true;

      const para = { 'search': query };

      window.axios.get('/api/users/search', { params: para }).then(({ data }) => {
        this.search.loading = false;
        this.search.load_users = data;
      });
    },
    checkParent(type, parent_module){
      switch (type) {
        case 'menu':
          this.menu_permissions.selected[parent_module] = parent_module;
        break;

        case 'other':
          this.other_permissions.selected[parent_module] = parent_module;
        break;
      }
    },
    uncheckChildrenIfUnchecked(type, parent_id, children) {
      switch (type) {
        case 'menu':
          if (children){
            if (!this.menu_permissions.selected[parent_id]){
              children.forEach((child) => {
                this.menu_permissions.selected[child.id] = null;
              });
            }
          }
        break;

        case 'other':
          if (children){
            if (!this.other_permissions.selected[parent_id]){
              children.forEach((child) => {
                this.other_permissions.selected[child.id] = null;
              });
            }
          }
        break;
      }
    },
    selectedUser (selectedOption) {
      this.search.select_user = selectedOption;
      this.global_user_id = this.search.select_user.user_id;
      this.global_access_id = this.search.select_user.access_id;

      const para = {
        r: 'accesswise-active',
        access_id: this.global_access_id
      }

      window.axios.get('/api/permission', { params: para }).then(({ data }) => {
        this.menu_permissions.selected = data.data.menu;
        this.other_permissions.selected = data.data.other;
      });
    },
    clearSearch () {
      this.search.select_user = "";
      this.load_users = [];
      this.global_user_id = 0;
      this.global_access_id = 0;

      this.menu_permissions.selected = [];
      this.other_permissions.selected = [];
    },
    fullIconName(icon) {
      return 'fi ' + icon;
    },
    savePermissions(){
      if (this.global_access_id == 0) return;

      const merged_array = {
        access_id: this.global_access_id,
        menu_permissions: this.menu_permissions.selected,
        other_permissions: this.other_permissions.selected
      };

      window.axios.post('/api/permission/save', merged_array).then(({ data }) => {
        if (data.result) {
          this.$swal('Success', 'Permission granted successfully!!', 'success');
        } else {
          this.$swal('Error', 'Permission grant failed', 'error');
        }
      }).catch((e) => {
        this.$swal('Error', 'Permission grant failed', 'error');
      });
    }
  },
  created () {
    this.allPermissions();
  }
};
</script>

<style src="./Permissions.scss" lang="scss" scoped />