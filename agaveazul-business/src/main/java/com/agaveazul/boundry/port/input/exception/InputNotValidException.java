package com.agaveazul.boundry.port.input.exception;

import java.util.Map;

public class InputNotValidException extends Exception {
    public Map<String,String> messages;

    public InputNotValidException(Map<String, String> messages) {
        this.messages = messages;
    }
}
