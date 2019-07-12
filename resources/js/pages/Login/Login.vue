<template>
  <div class="login-page">
    <b-container>
      <Widget class="mx-auto" title="<h3 class='mt-0 fw-normal text-center'>Login to Member Portal</h3>" customHeader>
        <b-row>
          <b-col md="12" class="mt-1">
            <img src="images/SLPP_LOGO.jpg" />
          </b-col>
        </b-row>
        
        <form class="mt" @submit.prevent.stop="login" novalidate>
          <b-alert class="alert-sm" variant="danger" :show="!!errorMessage">
            {{errorMessage}}
          </b-alert>
          <b-form-group id="frm-gr-username" label="Username:" label-for="username" :class="{ 'form-group--error': $v.form.username.$error }">
            <b-input-group id="in-gr-username" class="input-group-transparent">
              <b-input-group-text slot="prepend"><i class="fa fa-user text-maroon"></i></b-input-group-text>
              <b-form-input
                id="username"
                class="input-transparent"
                type="text"
                name="username"
                placeholder="Your Username"
                v-model="$v.form.username.$model"
                aria-describedby="feedback_username"
                :state="$v.form.username.$dirty ? !$v.form.username.$error : null"
              />
              <b-form-invalid-feedback id="feedback_username">
                Username is required.
              </b-form-invalid-feedback>
            </b-input-group>
          </b-form-group>
          <b-form-group id="frm-gr-password" label="Password:" label-for="password" :class="{ 'form-group--error': $v.form.password.$error }">
            <b-input-group id="in-gr-password" class="input-group-transparent">
              <b-input-group-text slot="prepend"><i class="fa fa-lock text-maroon"></i></b-input-group-text>
              <b-form-input
                id="password"
                class="input-transparent"
                type="password"
                name="password"
                placeholder="Your Password"
                v-model="$v.form.password.$model"
                aria-describedby="feedback_password"
                :state="$v.form.password.$dirty ? !$v.form.password.$error : null"
              />
              <b-form-invalid-feedback id="feedback_password">
                Password is required.
              </b-form-invalid-feedback>
            </b-input-group>
          </b-form-group>
          <div class="widget-middle-overflow bg-widget mt-4 px-4 py-3">
            <b-button class="btn-block btn-lg fs-normal mb-4" type="submit" variant="danger">
              <span v-if="!loading" class="login-circle"><i class="fa fa-caret-right"></i></span>
              <b-spinner v-if="loading" small variant="primary" class="mr-1 pb-1"></b-spinner>
              Sign in
            </b-button>
            <p class="text-center login-info">
              Don't have an account? Sign up now!
            </p>
            <a href="#" class="text-center text-gray w-100 d-block mt-1">Forgot Username or Password?</a>
            <p class="text-center login-info mt-4">
              Designed and developed by <a href="http://dtinnovations.lk" target="_blank">DTInnovations</a>
            </p>
          </div>
        </form>
      </Widget>
    </b-container>
  </div>
</template>

<script>
import Widget from 'RESO/js/components/Widget/Widget';
import { required, minLength } from 'vuelidate/lib/validators';
import { setTimeout } from 'timers';

export default {
  name: 'LoginPage',
  components: { Widget },
  data() {
    return {
      errorMessage: null,
      loading: false,
      form: {
        username: '',
        password: '',
      }
    };
  },
  validations: {
    form: {
      username: { required },
      password: { required },
    }
  },
  methods: {
    login() {
      const username = this.form.username;
      const password = this.form.password;

      this.$v.form.$touch();

      if (this.$v.form.$anyError) {
        console.error("Form submit validate errors on login form");
        return
      }

      if (username.length !== 0 && password.length !== 0) {
        this.loading = true;

        window.axios.post('/api/authenticate/login', this.form).then(({ data }) => {
          this.loading = false;


          if (data.result) {
            window.localStorage.setItem('authenticated', true);
            window.localStorage.setItem('access_id', data.data.access_id);
            window.localStorage.setItem('user_id', data.data.user_id);

            this.$router.push('/app/dashboard');
          } else {
            this.errorMessage = "Username or password is invalid!";
          }
        });
      }
    },
  },
  created() {
    if (window.localStorage.getItem('authenticated') === 'true') {
      this.$router.push('/app/dashboard');
    }
  },
};
</script>

<style src="./Login.scss" lang="scss" scoped />
