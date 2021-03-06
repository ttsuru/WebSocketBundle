# Configuration Reference

```yaml
gos_web_socket:
    client:
        session_handler:      ~ # Example: @session.handler.pdo
        firewall:             ws_firewall # Example: secured_area
        storage:
            driver:               gos_web_socket.client.driver.in_memory # Example: gos_web_socket.client.driver.in_memory
            ttl:                  900 # Example: 3600
            prefix:               '' # Deprecated (The "prefix" node is deprecated and will be removed in GosWebSocketBundle 4.0.), Example: client
            decorator:            ~
    shared_config:        true
    server:
        host:                 ~ # Required, Example: 127.0.0.1
        port:                 ~ # Required, Example: 8080
        origin_check:         false # Example: true

        # Flag indicating a keepalive ping should be enabled on the server
        keepalive_ping:       false # Example: true

        # The time in seconds between each keepalive ping
        keepalive_interval:   30 # Example: 30
        router:
            resources:

                # Prototype
                -
                    resource:             ~ # Required
                    type:                 null # One of "closure"; "container"; "glob"; "php"; "xml"; "yaml"; null
    origins:              []
    ping:
        services:

            # Prototype
            -

                # The name of the service to ping
                name:                 ~ # Required

                # The type of the service to be pinged; valid options are "doctrine" and "pdo"
                type:                 ~ # One of "doctrine"; "pdo", Required
    websocket_client:     # Deprecated (The "websocket_client" node is deprecated and will be removed in GosWebSocketBundle 4.0. Use the ratchet/pawl package instead.)
        enabled:              false
        host:                 ~ # Required, Example: 127.0.0.1
        port:                 ~ # Required, Example: 1337
        ssl:                  false
        origin:               null
    pushers:              # Deprecated (The "pushers" node is deprecated and will be removed in GosWebSocketBundle 4.0. Use the symfony/messenger component instead.)
        amqp:                 # Deprecated (The "amqp" node is deprecated and will be removed in GosWebSocketBundle 4.0. Use the symfony/messenger component instead.)
            enabled:              false
            host:                 ~ # Required, Example: 127.0.0.1
            port:                 ~ # Required, Example: 5672
            login:                ~ # Required
            password:             ~ # Required
            vhost:                /
            read_timeout:         0
            write_timeout:        0
            connect_timeout:      0
            queue_name:           gos_websocket
            exchange_name:        gos_websocket_exchange
        wamp:                 # Deprecated (The "wamp" node is deprecated and will be removed in GosWebSocketBundle 4.0. Use the symfony/messenger component instead.)
            enabled:              false
            host:                 ~ # Required, Example: 127.0.0.1
            port:                 ~ # Required, Example: 1337
            ssl:                  false
            origin:               null
```
