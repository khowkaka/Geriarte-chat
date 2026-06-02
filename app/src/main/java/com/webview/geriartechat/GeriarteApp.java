package com.webview.geriartechat;

import android.app.Application;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.os.Build;

public class GeriarteApp extends Application {
    public static final String CHANNEL_ID = "geriarte_notifications";

    @Override
    public void onCreate() {
        super.onCreate();
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            NotificationChannel channel = new NotificationChannel(
                CHANNEL_ID,
                "Geriarte notifications",
                NotificationManager.IMPORTANCE_HIGH
            );
            channel.setDescription("Messages, likes and comments");
            NotificationManager manager = getSystemService(NotificationManager.class);
            if (manager != null) manager.createNotificationChannel(channel);
        }
    }
}
