import lodash from 'lodash';
window._ = lodash;

import * as Bootstrap from 'bootstrap';
window.Bootstrap = Bootstrap;

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import moment from 'moment';
window.moment = moment;

import * as vue from 'vue';
window.Vue = vue;
window.ref = Vue.ref;
window.createApp = Vue.createApp;
window.onMounted = Vue.onMounted;

import * as vueI18n from 'vue-i18n';
window.VueI18n = vueI18n;
window.createI18n = VueI18n.createI18n;

import * as vueRouter from 'vue-router';
window.VueRouter = vueRouter;
window.createRouter = VueRouter.createRouter;
window.createWebHistory = VueRouter.createWebHistory;

import * as pinia from 'pinia';
window.Pinia = pinia;
window.createPinia = Pinia.createPinia;
