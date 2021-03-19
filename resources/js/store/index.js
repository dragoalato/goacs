import Vue from 'vue'
import Vuex from 'vuex'

import config from './config'
import device from './device'
import dashboard from './dashboard'
import template from './template'
import tasks from './tasks'
import file from './file'
import faults from './faults'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    sidebarShow: true,
    sidebarMinimize: false,
  },
  mutations: {
    toggleSidebarDesktop (state) {
      const sidebarOpened = [true, 'responsive'].includes(state.sidebarShow)
      state.sidebarShow = sidebarOpened ? false : 'responsive'
    },
    toggleSidebarMobile (state) {
      const sidebarClosed = [false, 'responsive'].includes(state.sidebarShow)
      state.sidebarShow = sidebarClosed ? true : 'responsive'
    },
    set (state, [variable, value]) {
      state[variable] = value
    },
  },
  actions: {
  },
  modules: {
    config,
    device,
    dashboard,
    template,
    tasks,
    file,
    faults,
  }
})

Vue.store = store;

export default store
