import router from ".";
import { useAuthStore } from "../stores/auth";
export default function check() {
  if (!useAuthStore().user) {
    router.push("/sign-in");
  }
}
