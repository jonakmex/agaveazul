package com.agaveazul.boundry.port.input;

import com.agaveazul.boundry.port.input.exception.InputNotValidException;

public abstract class InputPort {
    public boolean validate() throws InputNotValidException {
        return true;
    }
}
