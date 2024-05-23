import axiosInstance from "../services/axiosInstance";
import { useUserStore } from "../stores/userStore";

export async function login(credentials) {
  try {
    const response = await axiosInstance.post("/login", credentials);

    if (response.status >= 200 && response.status < 300) {
      const { access_token, expires_in, user } = response.data;
      const userStore = useUserStore();

      // Set token expiration time
      const expirationTime = new Date().getTime() + expires_in * 1000;

      // Save user info and token to Pinia store
      userStore.setUser(user);
      userStore.setAccessToken(access_token);
      userStore.setTokenExpiration(expirationTime);

      // Set Axios default header with the token
      axiosInstance.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${access_token}`;

      // Set up token refresh before it expires
      setTimeout(refreshToken, (expires_in - 60) * 1000); // refresh 1 minute before expiration

      alert("Login successful.");
      return response;
    } else {
      alert("Unauthorized access.");
    }
  } catch (error) {
    if (error.response) {
      alert(error.response.data.error || "Unauthorized access.");
    } else {
      alert("An unexpected error occurred.");
    }
  }
}

export async function register(userData) {
  try {
    const response = await axiosInstance.post("/register", userData);
    if (response.status >= 200 && response.status < 300) {
      alert("Registration successful.");
      return response;
    } else {
      alert("Registration failed.");
    }
  } catch (error) {
    if (error.response) {
      alert(error.response.data.error || "Registration failed.");
    } else {
      alert("An unexpected error occurred.");
    }
  }
}

export async function refreshToken() {
  try {
    const response = await axiosInstance.post("/refresh");
    if (response.status >= 200 && response.status < 300) {
      const { access_token, expires_in } = response.data;
      const userStore = useUserStore();

      // Update token expiration time
      const expirationTime = new Date().getTime() + expires_in * 1000;

      // Update Pinia store with new token and expiration
      userStore.setAccessToken(access_token);
      userStore.setTokenExpiration(expirationTime);

      // Update Axios default header with the new token
      axiosInstance.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${access_token}`;

      // Set up token refresh before it expires
      setTimeout(refreshToken, (expires_in - 60) * 1000); // refresh 1 minute before expiration

      alert("Token refreshed successfully.");
      return response;
    } else {
      alert("Token refresh failed.");
    }
  } catch (error) {
    if (error.response) {
      alert(error.response.data.error || "Token refresh failed.");
    } else {
      alert("An unexpected error occurred.");
    }
  }
}

export function initializeAuth() {
  const userStore = useUserStore();
  if (userStore.accessToken) {
    axiosInstance.defaults.headers.common[
      "Authorization"
    ] = `Bearer ${userStore.accessToken}`;

    // Set up token refresh if necessary
    const expirationTime =
      parseInt(userStore.tokenExpiration) - new Date().getTime();
    if (expirationTime > 0) {
      setTimeout(refreshToken, expirationTime - 60000); // refresh 1 minute before expiration
    }
  }
}
