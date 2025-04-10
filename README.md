## Pusher Integration

### 1. Set Up Pusher

   Pusher is a service for adding real-time functionality to apps. Here I use Pusher to broadcast product updates to the frontend without needing to reload the page.

   ### 2. Create a Pusher Account

   - Go to Pusher site and sign up for an account.
   - Create a new app and get all cred for example App_ID etc 

   ### 3. Update the `.env` File

   Add your Pusher credentials to the `.env` file:

   ```env
   BROADCAST_DRIVER=pusher
   PUSHER_APP_ID=your_pusher_app_id
   PUSHER_APP_KEY=your_pusher_app_key
   PUSHER_APP_SECRET=your_pusher_app_secret
   PUSHER_APP_CLUSTER=your_pusher_app_cluster
