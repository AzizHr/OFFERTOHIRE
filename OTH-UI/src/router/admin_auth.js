
function isAdminLoggedIn() {

  const token = localStorage.getItem("token");
  const user = JSON.parse(localStorage.getItem("user"));

  if (token && user.role == "admin") {
    return true;
  }

  return false
}

export default isAdminLoggedIn;
