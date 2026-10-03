# Fieldnote Product Inventory

React frontend for the LavaLust product API.

## Run locally

1. Copy `.env.example` to `.env` and set `VITE_API_BASE_URL` if the API is not at `http://127.0.0.1:3000/api`.
2. From this directory, run `npm install` and `npm run dev`.
3. Start LavaLust with `php lava serve` from the repository root.

The first screen supports account registration and sign-in. Access and refresh tokens are stored in browser local storage; the frontend refreshes expired access tokens and revokes the refresh token on sign-out.