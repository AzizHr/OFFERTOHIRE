
function isCompanyLoggedIn() {

  const token = localStorage.getItem("token");
  const user = JSON.parse(localStorage.getItem("user"));

  if (token && user.role == "company") {
    return true;
  }

  return false
}

export default isCompanyLoggedIn;
