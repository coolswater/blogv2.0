<template>
  <div class="bg-white">
    <headers />
    <footers />
  </div>
</template>

<script>
import headers from '../components/Headers'
import footers from '../components/Footers'
export default {
  name: 'Profile',
  components: {
    headers,
    footers
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
