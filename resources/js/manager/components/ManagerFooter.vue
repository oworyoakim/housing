<template>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 0.0.1
    </div>
    <strong>Copyright &copy; {{year}} <a href="#">Housing</a>.</strong>
    All rights
    reserved.
  </footer>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'ManagerFooter',
  data() {
    return {
      year: (new Date).getFullYear(),
    }
  },
});
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
