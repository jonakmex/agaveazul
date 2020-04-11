package com.agaveazul.gateway;

import org.springframework.context.annotation.ComponentScan;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.ImportResource;

@Configuration
@ImportResource("context-gateway.xml")
@ComponentScan(basePackages = {"com.agaveazul.gateway"})
public class ConfigGateway {

}
