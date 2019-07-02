<template>
  <b-col md="4" class="category-container">
    <b-form-group :id="default_group_id" :label="label" :label-for="id">
      <b-form-select class="mb-3" :id="id" @input="onSelect" @change="onChange" v-model="selectedOption">
        <option v-for="option in options" :key="option.id" :value="option.id">{{ option.name }}</option>
      </b-form-select>
    </b-form-group>
  </b-col>
</template>

<script>
export default {
  name: 'Category',
  data() {
    return {
      selectedOption: null
    }
  },
  props: {
    id: { type: String, default: "", required: true },
    groupId: { type: String, default: "" },
    label: { type: String, default: "" },
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

<style src="./Category.scss" lang="scss" />