package com.agaveazul.boundry.port.input;

import com.agaveazul.boundry.port.input.exception.InputNotValidException;
import lombok.Data;

import java.util.HashMap;
import java.util.Map;
@Data
public class SaveUnitInputPort extends InputPort{
    public Long id;
    public String description;

    @Override
    public boolean validate() throws InputNotValidException {
        Map<String,String> messages = new HashMap<>();
        if(description == null || description.length() < 3 || description.length() > 50)
            messages.put("description","msg_err_001");

        if(!messages.isEmpty())
            throw new InputNotValidException(messages);

        return true;
    }
}
