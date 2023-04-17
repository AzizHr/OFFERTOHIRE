import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import PostsView from "../views/posts/PostsView.vue";
import OffersView from "../views/offers/OffersView.vue";
import SignInView from "../views/SignInView.vue";
import UserSignUpView from "../views/user/UserSignUpView.vue";
import ProfileView from "../views/user/ProfileView.vue";
import CompanySignUpView from "../views/company/CompanySignUpView.vue";
import PostDetailsView from "../views/posts/PostDetailsView.vue";
import NewPostView from "../views/posts/NewPostView.vue";
import NewOfferView from "../views/offers/NewOfferView.vue";
import NewSkillView from "../views/user/NewSkillView.vue";
import MyApplicationsView from "../views/user/MyApplicationsView.vue";
import Users from "../views/admin/Users.vue";
import Posts from "../views/admin/Posts.vue";
import Offers from "../views/admin/Offers.vue";
import NewApplicationView from "../views/user/NewApplicationView.vue";
import PortfolioView from "../views/user/PortfolioView.vue";
import ChatView from "../views/ChatView.vue";
import NotFound from "@/components/NotFound.vue";
import isUserLoggedIn from "./user_auth";
import isCompanyLoggedIn from "./company_auth";
import isAdminLoggedIn from "./admin_auth";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/admin/users",
      name: "admin.users",
      component: Users,
      beforeEnter: (to, from, next) => {
        if (isAdminLoggedIn()) {
          next();
        } else {
          next("/sign-in");
        }
      },
    },
    {
      path: "/admin/posts",
      name: "admin.posts",
      component: Posts,
      beforeEnter: (to, from, next) => {
        if (isAdminLoggedIn()) {
          next();
        } else {
          next("/sign-in");
        }
      },
    },
    {
      path: "/admin/offers",
      name: "admin.offers",
      component: Offers,
      beforeEnter: (to, from, next) => {
        if (isAdminLoggedIn()) {
          next();
        } else {
          next("/sign-in");
        }
      },
    },
    {
      path: "/chat/:id",
      name: "chat",
      component: ChatView,
      beforeEnter: (to, from, next) => {
        if (isUserLoggedIn()) {
          next();
        } else {
          next("/sign-in");
        }
      },
    },
    {
      path: "/profile/:id/847091JN82379HHS92839JDJW",
      name: "profile",
      component: ProfileView,
      beforeEnter: (to, from, next) => {
        if (isUserLoggedIn()) {
          next();
        } else {
          next("/sign-in");
        }
      },
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
      beforeEnter: (to, from, next) => {
        if (isUserLoggedIn()) {
          next();
        } else {
          next("/sign-in");
        }
      },
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
      beforeEnter: (to, from, next) => {
        if (isCompanyLoggedIn()) {
          next();
        } else {
          next("/sign-in");
        }
      },
    },
    {
      path: "/skills/new",
      name: "newskill",
      component: NewSkillView,
      beforeEnter: (to, from, next) => {
        if (isUserLoggedIn()) {
          next();
        } else {
          next("/sign-in");
        }
      },
    },
    {
      path: "/offers/:id/apply",
      name: "newapplication",
      component: NewApplicationView,
      beforeEnter: (to, from, next) => {
        if (isUserLoggedIn()) {
          next();
        } else {
          next("/sign-in");
        }
      },
    },
    {
      path: "/portfolio/:id",
      name: "portfolio",
      component: PortfolioView,
      beforeEnter: (to, from, next) => {
        if (isUserLoggedIn()) {
          next();
        } else {
          next("/sign-in");
        }
      },
    },
    {
      path: "/my-applications",
      name: "myapplications",
      component: MyApplicationsView,
      beforeEnter: (to, from, next) => {
        if (isUserLoggedIn()) {
          next();
        } else {
          next("/sign-in");
        }
      },
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
      path: "/:pathMatch(.*)*",
      name: "notfound",
      component: NotFound,
    },
  ],
});

export default router;
