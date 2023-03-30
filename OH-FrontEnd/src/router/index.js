import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import AboutView from "../views/AboutView.vue";
import ContactView from "../views/ContactView.vue";
import PostsView from "../views/posts/PostsView.vue";
import OffersView from "../views/offers/OffersView.vue";
import SignInView from "../views/SignInView.vue";
import UserSignUpView from "../views/user/UserSignUpView.vue";
import CompanySignUpView from "../views/company/CompanySignUpView.vue";
import PostDetailsView from "../views/posts/PostDetailsView.vue";
import NewPostView from "../views/posts/NewPostView.vue";
import NewOfferView from "../views/offers/NewOfferView.vue";
import NotFound from '@/components/NotFound.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/about",
      name: "about",
      component: AboutView,
    },
    {
      path: "/contact",
      name: "contact",
      component: ContactView,
    },
    {
      path: "/posts",
      name: "posts",
      component: PostsView,
    },
    {
      path: "/posts/:id",
      name: "postdetails",
      component: PostDetailsView,
      props: true,
    },
    {
      path: "/posts/new",
      name: "newpost",
      component: NewPostView,
      // beforeEnter: auth
    },
    {
      path: "/offers",
      name: "offers",
      component: OffersView,
    },
    {
      path: "/offers/new",
      name: "newoffer",
      component: NewOfferView,
      // beforeEnter: auth
    },
    {
      path: "/sign-in",
      name: "signin",
      component: SignInView,
    },
    {
      path: "/user/sign-up",
      name: "usersignup",
      component: UserSignUpView,
    },
    {
      path: "/company/sign-up",
      name: "companysignup",
      component: CompanySignUpView,
    },
    {
      path: '/:pathMatch(.*)*',
      name: "notfound",
      component: NotFound,
    },
  ],
});

export default router;
