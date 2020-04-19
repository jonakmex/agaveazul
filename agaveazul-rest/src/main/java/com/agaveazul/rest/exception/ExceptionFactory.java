package com.agaveazul.rest.exception;

import org.springframework.http.HttpStatus;
import org.springframework.web.server.ResponseStatusException;

import java.util.Map;

public class ExceptionFactory {
    public static ResponseStatusException newResponseStatusException(HttpStatus status, Map<String,String> messages){
        StringBuilder message = new StringBuilder();
        messages.entrySet().stream().forEach(key->{
            message.append(key)
                    .append(":")
                    .append(messages.get(key))
                    .append("|");
        });
        return new ResponseStatusException(status,message.toString());
    }

}
