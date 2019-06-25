<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>View Templates</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Template - <span class="fw-semi-bold">View</span>
    </h1>

    <b-row>
      <b-col lg="6">
        <Widget>
          {{message}}
        </Widget>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import Widget from 'RESO/js/components/Widget/Widget';

export default {
  name: 'AnotherPage',
  components: { Widget },
  data() {
    return {
      message: 'View Templates'
    }
  }
};
</script>
