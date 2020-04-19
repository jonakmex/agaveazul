package com.agaveazul.entitiy;

import com.agaveazul.entitiy.enums.UnitStatus;
import lombok.Data;

@Data
public class Unit {
    private Long id;
    private String description;
    private UnitStatus status;
}
