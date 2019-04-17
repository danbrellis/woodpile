import Vue from "vue";
import Router from "vue-router";
import AddStack from "./views/AddStack.vue";
import Home from "./views/Home.vue";
import Pile from "./views/Pile.vue";

Vue.use(Router);

export default new Router({
  mode: "history",
  base: process.env.BASE_URL,
  routes: [
    {
      path: "/",
      name: "home",
      component: Home
    },
    {
      path: "/pile/:pileId",
      name: "pile",
      component: Pile
    },
    {
      path: "/pile/:pileId/stack/add",
      name: "addStack",
      props: true,
      component: AddStack
    },
    {
      path: "/about",
      name: "about",
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () =>
        import(/* webpackChunkName: "about" */ "./views/About.vue")
    },
    {
      path: "*",
      component: Home
    }
  ]
});
