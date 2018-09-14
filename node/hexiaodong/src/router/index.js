import Vue from 'vue'
import Router from 'vue-router'
import Profile from '@/pages/Profile'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Profile',
      component: Profile
    }
  ]
})
