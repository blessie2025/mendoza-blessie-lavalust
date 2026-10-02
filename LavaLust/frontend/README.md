# Stockroom React Frontend

The frontend communicates with the LavaLust API; it does not connect to MySQL.

## Local development

Copy `.env.example` to `.env.local`, then set `VITE_API_BASE_URL` to the URL where LavaLust is running.

```powershell
npm ci
npm run dev
```

## Render Static Site

- Root directory: repository root
- Build command: `npm ci && npm run build`
- Publish directory: `dist`
- Environment variable `VITE_API_BASE_URL`: the deployed LavaLust API origin, with no trailing slash
- Environment variable `VITE_APP_HOME`: `/`

Add the resulting frontend origin to the LavaLust API's `API_ALLOWED_ORIGINS` environment variable. For session authentication across Render origins, configure `COOKIE_SECURE=true` and `COOKIE_SAMESITE=None` on the API service.