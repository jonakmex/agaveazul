package com.agaveazul.rest;

import com.agaveazul.gateway.ConfigGateway;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.Import;
import org.springframework.context.annotation.ImportResource;

@Configuration
@ImportResource("context-service.xml")
@Import(ConfigGateway.class)
public class ConfigService {
}
