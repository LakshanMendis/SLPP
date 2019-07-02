<template>
  <b-col md="4" class="multiple-category-container">
    <b-form-group :id="default_group_id" :label="label" :label-for="id">
      <multiselect 
        class="multi-category"
        :multiple='true'
        :searchable='true'
        :preserve-search="true"
        :hide-selected="false"
        :clear-on-select='false'
        :close-on-select='false'
        :max-height='300'
        :show-no-results='true'
        :taggable='false'
        :id="id"
        :placeholder="placeholder"
        :options="options"
        label="name"
        v-model="selectedOption"
        track-by="id"
        @input="onSelect" 
        @select="onChange"
      >
        <span slot="noResult">No matching found</span>
        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected</span></template>
      </multiselect>
    </b-form-group>

    <!--
      <b-form-select class="mb-3"  @input="onSelect" @change="onChange" v-model="selectedOption">
        <option v-for="option in options" :key="option.id" :value="option.id">{{ option.name }}</option>
      </b-form-select>
    -->
  </b-col>
</template>

<style src="./../../../../node_modules/vue-multiselect/dist/vue-multiselect.min.css"></style>

<script>
import Multiselect from 'vue-multiselect';

export default {
  name: 'CategoryMultiple',
  components: { Multiselect },
  data() {
    return {
      selectedOption: null
    }
  },
  props: {
    id: { type: String, default: "", required: true },
    groupId: { type: String, default: "" },
    label: { type: String, default: "" },
    placeholder: { type: String, default: "" },
    options: { default: [] },
    value: null
  },
  computed: {
    default_group_id: function () {
      const internal_default_group_id = (this.groupId == "") ? "group-" + this.id : this.groupId;

      return internal_default_group_id;
    }
  },
  methods: {
    onSelect() {
      this.$emit('input', this.selectedOption);
    },
    onChange() {
      this.$emit('change', this.selectedOption);
    }
  },
  mounted() {
    this.selectedOption = this.value;
  },
  watch: {
    value: function (newValue) {
      this.selectedOption = newValue
    }
  }
};
</script>

<style src="./CategoryMultiple.scss" lang="scss" />