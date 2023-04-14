import { useRouter } from "vue-router";

function isUserLoggedIn() {
  const router = useRouter();

  const token = localStorage.getItem("token");
  const user = JSON.parse(localStorage.getItem("user"));

  if (token && user.role == "user") {
    return true;
  }

  return false
}

export default isUserLoggedIn;
